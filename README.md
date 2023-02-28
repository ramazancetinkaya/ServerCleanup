# Server Cleanup

## Usage

```php
// Include the ServerCleanup class file.
require_once('ServerCleanup.php');

// Call the clearAll() method to clear all sessions and cookies on the server.
ServerCleanup::clearAll();

// Optionally, you can provide an array of cookie names to keep when calling the clearAll() method.
ServerCleanup::clearAll(['cookie1', 'cookie2']);
```
