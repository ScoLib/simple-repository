# Laravel Simple Repository

code from https://github.com/rinvex/laravel-repositories



## 安装

``` bash
$ composer require scolib/simple-repository
```

## 使用

``` php
namespace App\Repositories;

use Sco\Repository\BaseRepository;

class FooRepository extends BaseRepository
{
    protected $model = 'App\Models\User';
}
```

## Model自动引入

当Repository是 `App\Demos\Repositories\ItemRepository`，而Model是 `App\Demos\Models\Item` 时，Repository会自动进入该Model，而不必手动定义 `protected $model`

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
