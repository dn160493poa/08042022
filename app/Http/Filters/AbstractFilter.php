<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

abstract class AbstractFilter implements FilterInterface
{
    /** @var array */
    private array $query_params = [];

    /**
     * AbstractFilter constructor.
     * @param array $query_params
     */
    public function __construct(array $query_params)
    {
        $this->query_params = $query_params;
    }

    abstract protected function getCallBacks(): array;

    public function apply(Builder $builder)
    {
        $this->before($builder);

        foreach ($this->getCallBacks() as $name => $call_back) {
            if (isset($this->query_params[$name])){
                call_user_func($call_back, $builder, $this->query_params[$name]);
            }
        }
    }

    /**
     * @param Builder $builder
     */
    protected function before(Builder $builder)
    {
    }

    /**
     * @param string $key
     * @param mixed|null $default
     *
     * @return mixed|null
     */
    protected function getQueryParam(string $key, $default = null)
    {
        return $this->queryParams[$key] ?? $default;
    }

    /**
     * @param string[] $keys
     *
     * @return AbstractFilter
     */
    protected function removeQueryParam(string ...$keys)
    {
        foreach ($keys as $key) {
            unset($this->query_params[$key]);
        }

        return $this;
    }

}
