<?php

declare(strict_types=1);

namespace Buildit\Routing;

use Illuminate\Routing\Router;

class Buildit
{
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function apiResource($name, $controller, array $options = [])
    {
        $this->router->get("$name", "$controller@index")->name("$name.index");
        $this->router->get("$name/list", "$controller@list")->name("$name.list");
        $this->router->get("$name/action-create", "$controller@createAction")->name("$name.action.create");
        $this->router->get("$name/{id}", "$controller@show")->name("$name.show")->whereNumber('id');
        $this->router->post("$name", "$controller@store")->name("$name.store");
        $this->router->put("$name/{id}", "$controller@update")->name("$name.update")->whereNumber('id');
        $this->router->delete("$name/{id}", "$controller@destroy")->name("$name.destroy")->whereNumber('id');
    }
}
