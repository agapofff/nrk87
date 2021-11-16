Yii2-tree
==========
Это модуль, который построит дерево элементов на основе модели(подойдет для админки в случае, когда категорий много и они вложены друг в друга). Модель должна быть наследником AR, привязана к таблице БД, где хранится дерево (предок указывается в поле parent_id).
В скором будущем появится возможность дгандропом менять позицию каждого элемента.

Установка
==========

Выполнить команду

```
php composer require dvizh/yii2-tree "@dev"
```

Или добавить в composer.json

```
"dvizh/yii2-tree": "@dev",
```

И выполнить

```
php composer update
```
Подключение и настройка
---------------------------------
В конфигурационный файл приложения добавить компонент cart
```php
    'components' => [
        'treeSettings' => [
            'class' => 'dvizh\tree\TreeSettings',
            'models' => [
                '\dvizh\shop\models\Category' => [], //массив с настройками. Если не чего не передать, будут установлены дефолтные настройки. Все настроки описаны ниже. 
            ],   
        ],
    ]
```

И модуль (если хотите использовать виджеты)

```php
    'modules' => [
        'tree' => [
            'class' => 'dvizh\tree\Module',
            'adminRoles' => ['@'],
        ],
        //...
    ]
```

Использование
==========
Во вью, где хотите вывести дерево, вызываете виджет:

```php
<?=\dvizh\tree\widgets\Tree::widget(['model' => $model::className()]);?>
```

Все возможные настроки компонента(TreeSettings):

* model - класс с которого будет строиться дерево (по умолчанию '\dvizh\shop\models\Category')
* parentField - наименование поля, где хранится родитель (по умолчанию 'parent_id')
* idField - наименование поля уник. идентификатора (по умолчанию 'id')
* orderField - наименование поля, по которому необходимо производить сортировку (по умолчанию false)
* updateUrl - урл ссылки на редактирование (по умолчанию 'category/update')
* viewUrl - урл на просмотр (по умолчанию 'product/index')
* viewUrlToSearch - переключатель, должен ли просмотр вести на грид с поиском (по умолчанию true)
* viewUrlModelName - наименование поисковой модели (по умолчанию 'ProductSearch')
* viewUrlModelField - наименование поля, по которому связывается искомые продукты с моделью, переданной в виджет (по умолчанию 'category_id')
* view - вьюха (по умолчанию 'index')
* deleteUrl - урл по которому будет удаляться категория (по умолчанию '/tree/tree/delete')
* expandUrl - урл по которому будет возвращаться дочернии категории (по умолчанию '/tree/tree/expand')
* showId - отобразить id категории (по умолчанию false)