<?php

namespace App\Console\Commands;

use App\Components\ImportDataClient;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Console\Command;

class ImportsPostsDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:httpposts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get posts from lifehacker.com';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() : void
    {
        $import = new ImportDataClient();
        $response = $import->client->request('GET', 'rss');
        $data = $this->getData($response);

        foreach ($data as $item){
            if(isset($item['title'], $item['description'], $item['category'])){
                $arr = explode('<p>',  $item['description']);

                $post = Post::firstOrCreate([
                    'title' => $item['title']
                ], [
                    'title' => $item['title'],
                    'content' => $this->getContent($arr[1]),
                    'image' => $this->getUrl($arr[0])
                ]);

                foreach ($item['category'] as $one_category => $value){
                    $category_id = Category::firstOrCreate(
                        [
                            'title' => $value
                    ], [
                            'title' => $value
                        ]
                    );
                    $post->categories()->sync($category_id);
                }
            }
        }
        echo 'Command is finished';
    }

    private function getData($response) : array
    {
        $xml = simplexml_load_string($response->getBody()->getContents(), "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
        $data = $array['channel']['item'];
        return $data;
    }

    private function getContent(string $str) : string
    {
        return strip_tags($str);
    }

    private function getUrl(string $str) : string
    {
        return preg_replace('/(\s\/|[<>"]|img\ssrc=)/', '', $str);
    }
}
