<?php
return [
    'scope' => env('SMAREGI_DEFAULT_SCOPE', "pos.products:read pos.products:write pos.stores:read pos.stock:read pos.stock:write pos.stock-changes:read pos.transactions:read pos.orders:read pos.orders:write pos.transfers:read pos.transfers:write pos.stocktaking:read"),
    'grant_type' => env('SMAREGI_GRANT_TYPE', "client_credentials"),
    'contract_id' => env('SMAREGI_CONTRACT_ID', ""),
    'client_id' => env('SMAREGI_CLIENT_ID', ""),
    'client_secret' => env('SMAREGI_CLIENT_SECRET', ""),
    'token_base_url' => env('SMAREGI_BASE_URL_FOR_TOKEN', "https://id.smaregi.jp/app/"),
    'base_url' => env('SMAREGI_BASE_URL', "https://api.smaregi.jp"),
];
