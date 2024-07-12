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

    public function __construct(SmaregiConnection $connection){
        $this->connection = $connection;
    }
    
    public function checkConnection(){
        return $this->connection->get('pos/products');
    }
}

```
