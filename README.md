Validate Embedded
=================

This library provides the `Validate` constraint for the
[Symfony Validator Component](https://github.com/symfony/validator).

This constraint behaves similar to the built-in `Valid` constraint, but respects
the `groups` option. Additionally, it adds an option to specify the validation
groups to target on the embedded object(s).

## Installation

Open a command console, enter your project directory and execute the following
command to download the latest stable version of this bundle:

```bash
$ composer require fluoresce/validate-embedded
```

This command requires you to have Composer installed globally, as explained in
the [installation chapter](https://getcomposer.org/doc/00-intro.md) of the
Composer documentation.

## Documentation

_The following examples assume you are using the full Symfony framework, though
this package can be used in any project that has the Symfony Validator Component
available_

### Basic Usage

This example shows an `Author` which has a collection of `Book`s. When
validation is run for `group1` on `Author`, it will cascade to all embedded
`Book` instances.

The behaviour here is slightly different to the standard `Valid` constraint, as
validation of the `Book` instances is run with the default group.

```php
<?php

use Fluoresce\ValidateEmbedded\Constraints as Fluoresce;

class Author
{
    /**
     * @var Book[]
     * @Fluoresce\Validate(groups={"group1"});
     */
    private $books;
}
```

```php
<?php

use Symfony\Component\Validator\Constraints as Assert;

class Book
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $title;
}
```

### Specifying Embedded Validation Groups

Imagine we want to specify different validation groups to be run on the `Book`
instances. We can target these by specifying them in the `Validate` annotation.

```php
<?php

use Fluoresce\ValidateEmbedded\Constraints as Fluoresce;

class Author
{
    /**
     * @var Book[]
     * @Fluoresce\Validate(embeddedGroups={"bookgroup1"});
     */
    private $books;
}
```

```php
<?php

use Symfony\Component\Validator\Constraints as Assert;

class Book
{
    /**
     * @var string
     * @Assert\NotBlank(groups={"bookgroup1"})
     */
    private $title;
}
```

Now whenever an `Author` instance is validated, the embedded `Book`s will be
validated with validation group `bookgroup1`.

### Combining All Options

This example combines behaviour from the previous ones to show how it operates
together.

```php
<?php

use Fluoresce\ValidateEmbedded\Constraints as Fluoresce;

class Author
{
    /**
     * @var Book[]
     * @Fluoresce\Validate(groups={"group1"}, embeddedGroups={"bookgroup1"});
     */
    private $books;
}
```

```php
<?php

use Symfony\Component\Validator\Constraints as Assert;

class Book
{
    /**
     * @var string
     * @Assert\NotBlank(groups={"bookgroup1"})
     */
    private $title;
}
```
