Doctrine Extension
========================

Example of using the Translation part of [StofDoctrineExtensionsBundle](https://github.com/stof/StofDoctrineExtensionsBundle)

## How to use
Clone this repo, install the vendors with composer and setup your database.
Load the fixtures :
```
app/console doctrine:fixtures:load
```

## How it works
All the example files are in the HelpBoxBundle. 
To see the example go to the url :
* /fr/doctrine-translations [for French example]
* /de/doctrine-translations [for German example]
* /en/doctrine-translations [for English example]

The example entity is **Article** with a title field and a content field.
To improve performance, we override the *findAll* in the *ArticleRepository*. It prevents executing a database query for every title list in the form
```php
public function findAll()
{
    $query = $this->createQueryBuilder('a')
            ->getQuery()
            ;
    $query->setHint(
    \Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER, 'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
    );
    return $query->getResult();
}
```


