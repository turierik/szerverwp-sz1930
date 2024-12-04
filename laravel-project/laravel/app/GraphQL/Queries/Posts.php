<?php declare(strict_types=1);

namespace App\GraphQL\Queries;
use App\Models\Post;

final readonly class Posts
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        return Post::all();
    }
}
