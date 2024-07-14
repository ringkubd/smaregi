<?php

namespace Anwar\Smaregi\Controller;

use Anwar\Smaregi\SmaregiConnection;
use App\Http\Controllers\Controller;

class SmaregiController extends Controller
{
    protected SmaregiConnection $connection;

    /**
     * @param SmaregiConnection $connection
     */
    public function __construct(SmaregiConnection $connection){
        $this->connection = $connection;
    }

    /**
     * GET Method example
     */

    public function getCategories(){
        return $this->connection->get('pos/categories', [
            'categoryName' => "Test categoryName by pos developer2"
        ]);
    }
    /**
     * POST method Example
     */
    public function storeCategories(){
        return $this->connection->post('pos/categories', [
            "categoryName" => "Test Category"
        ]);
    }

    /**
     * DELETE method Example
     */
    public function deleteCategory($id){
        return $this->connection->delete('pos/categories', $id);
    }

    /**
     * PATCH method Example
     */
    public function updateCategory($id){
        return $this->connection->patch('pos/categories', $id, [
            "categoryName" => "Test Category Updated"
        ]);
    }
}
