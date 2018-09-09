<?php

/**
 * One to One
 */
$this->get('one-to-one', 'OneToOneController@oneToOne');
$this->get('one-to-one-inverse', 'OneToOneController@oneToOneInverse');
$this->get('one-to-one-insert', 'OneToOneController@oneToOneInsert');

/**
 * One to Many
 */
$this->get('one-to-many', 'OneToManyController@oneToMany');
$this->get('many-to-one', 'OneToManyController@manyToOne');
$this->get('one-to-many-two', 'OneToManyController@oneToManyTwo');
$this->get('one-to-many-insert', 'OneToManyController@oneToManyInsert');
$this->get('has-many-through', 'OneToManyController@hasManyThrough');

/**
 * Many to Many
 */
$this->get('many-to-many', 'ManyToManyController@manyToMany');
$this->get('many-to-many-inverse', 'ManyToManyController@manyToManyInverse');
$this->get('many-to-many-insert', 'ManyToManyController@manyToManyInsert');

/**
 * Polymorphic
 */
$this->get('polymorphic', 'PolymorphicController@polymorphics');
$this->get('polymorphic-insert', 'PolymorphicController@polymorphicInsert');

Route::get('/', function () {
    return view('welcome');
});
