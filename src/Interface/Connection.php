<?php

namespace Anwar\Smaregi\Interface;

interface Connection
{
    public function getAccessToken();
    public function get(string $path, array $params = []);

    public function post(string $path, array $body = []);

    public function patch(string $path, int $id, array $body = []);
    public function put(string $path, array $body = []);

    public function delete(string $path, int $id);
}
