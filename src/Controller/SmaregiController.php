<?php

namespace Anwar\Smaregi\Controller;

use Anwar\Smaregi\SmaregiConnection;
use App\Http\Controllers\Controller;
use Spatie\FlareClient\Http\Exceptions\BadResponse;

class SmaregiController extends Controller
{
    protected SmaregiConnection $connection;

    public function __construct(SmaregiConnection $connection){
        $this->connection = $connection;
    }

    /**
     * @throws BadResponse
     */
    public function checkConnection(){
        return $this->connection->get('pos/categories', [
            'categoryName' => "Test categoryName by pos developer2"
        ]);
    }
}
