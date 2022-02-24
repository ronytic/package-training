# Processmaker Package Training
This package provides the necessary base code to start the developing a package in ProcessMaker 4.

## Development
If you need to create a new ProcessMaker package run the following commands:

```
git clone https://github.com/ProcessMaker/package-training.git
cd package-training
php rename-project.php package-training
composer install
npm install
npm run dev
```

## Installation
* Use `composer require processmaker/package-training` to install the package.
* Use `php artisan package-training:install` to install generate the dependencies.

## Navigation and testing
* Navigate to administration tab in your ProcessMaker 4
* Select `Skeleton Package` from the administrative sidebar

## Uninstall
* Use `php artisan package-training:uninstall` to uninstall the package
* Use `composer remove processmaker/package-training` to remove the package completely
