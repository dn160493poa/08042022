<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class PostFilter extends AbstractFilter
{
    public const TITLE = 'title';
    public const CONTENT = 'content';
    public const SEARCH = 'search';

    protected function getCallBacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
            self::CONTENT => [$this, 'content'],
            self::SEARCH => [$this, 'search'],
        ];
    }

    public function title(Builder $builder, $value)
    {
        $builder->where('title', 'ilike', "%{$value}%");
    }

    public function content(Builder $builder, $value)
    {
        $builder->where('content', 'ilike', "%{$value}%");
    }

    public function search(Builder $builder, $value)
    {
        $builder
            ->where('title', 'ilike', "%{$value}%")
            ->orWhere('content', 'ilike', "%{$value}%");
    }
}
