## Installation
```bash
composer require anwar/smaregi
```
## Environment Variables

To use the AwesomePackage, you need to add the following variables to your `.env` file:
````
SMAREGI_CONTRACT_ID=
SMAREGI_CLIENT_ID=
SMAREGI_CLIENT_SECRET=
SMAREGI_BASE_URL_FOR_TOKEN=
SMAREGI_BASE_URL=
````
## Example

```PHP
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


```
