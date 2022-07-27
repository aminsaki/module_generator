# Generate modules Laravel

## installation  

Generate modules operations With Repositoriy Design Pattern 


## step one 
 composer require holoo/module_generator  
 
 Add the \Holoo\ModuleGenerator\ServiceProvider\ModuleGeneratorServiceProvider::class to config/app.php (comment out built-in ModuleGeneratorServiceProvider):


## step Two  


 'providers' => array(
 
     ...
     // '\Holoo\ModuleGenerator\ServiceProvider\ModuleGeneratorServiceProvider::class',
     'Very\Redis\RedisServiceProvider',
     ...
     
 ),
 ...
 
## run create module  

// Use the following command to create the module    

// Enter the name of the module you want to create instead of the name character

php artisan modules:generate {name} 

-------------------------------------


## run delete module  

// Use the following command to remove a module

// Enter the name of the module you want to create instead of the name character

php artisan  modules:delete {name}

 
