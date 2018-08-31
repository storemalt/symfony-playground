# Symfony Playground

This is a starter app from Symfony4 for easy forking for new starters.

## Setup

1. Install [Virtualbox](https://www.virtualbox.org/wiki/Downloads)
2. Install [Vagrant](https://www.vagrantup.com/)
3. Run `vagrant plugin install vagrant-hostsupdater`
4. Run `vagrant up`

You now have a web server running on <http://symfony.local>.

## Using the project

You can edit the code directly in this directory to make changes.
You can ssh into the vagrant box with `vagrant ssh`.
Get to the code with `cd /srv/www/app/current`.
Once inside the vagrant box you can run Symfony commands, here are some useful ones:

```sh
# Clear the Symfony cache
$ bin/console cache:clear
```


### Tasks

#### Homepage

1. Create a new Controller with an index action
2. Create a route in `routes.yaml` for the index action at the `/` path
3. Create a new twig template in `templates/`
4. Make the twig template extend `base.html.twig`
5. Make the index action render the new template
6. Pass some variables through to the twig template and render them
7. Play with adding new variables and removing them


#### Request parameters

1. Create a hello action in your Controller
2. Create a route for the action, give the route a path parameter of `{name}`
3. Add `Request $request` and `string $name` as parameters to the action
4. Get the `lastName` parameter from the `$request` with a suitable default value if it doesn't exist
5. Create a new twig template and pass the two names through to it
6. Make the twig template render the names
7. Play with the path and request parameters


#### Database entities

1. Create your database schema
    ```sh
    $ ./bin/console doctrine:database:create
    ```
2. Create a `Post` entity in `Entity/`
3. Give it the following attributes:
    - string id
    - string slug
    - string title
    - string text
    - \DateTimeImmutable $createdAt
    - \DateTimeImmutable $updatedAt
4. Import `Doctrine\ORM\Mapping as ORM`, these are the Doctrine annotations you'll use to define the schema
5. Add the `@ORM\Entity` annotation to the class
6. Add the `@ORM\Column(type=<your type>)` annotation to each property
    - Choose which type you want from the [Doctrine docs](https://www.doctrine-project.org/projects/doctrine-dbal/en/2.8/reference/types.html)
7. Add the following annotations to the `id` field to make MySQL automatically generate it:
    ```php
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    ``` 
8. Check the SQL that Doctrine wants to run to update the database
    ```sh
    $ ./bin/console doctrine:schema:update --dump-sql
    ```
9. If the SQL makes sense, execute it
    ```sh
    $ ./bin/console doctrine:schema:update --force
    ```
10. Get the details to log into the database from the `.env` file
    ```
    DATABASE_URL=mysql://<username>:<password>@127.0.0.1:3306/<db name>
    ```
11. Log into the database
    ```sh
    $ mysql -u <username> -p <db name>
    ```
12. Have a play, here are some fun SQL commands
    ```sql
    show tables;
    describe post;
    select * from post;
    ```


#### Symfony forms

1. Create a `PostType` class in `Form/` that extends `AbstractType`
2. Implement the `buildForm(FormBuilderInterface $builder, array $options)` function
3. Add a few fields to the form with `$bulider->add()` that exist in the `Post` entity, eg.
    ```php
    $builder->add('title')
    ```
4. The second argument to the `add()` function allows you to change the type of the form field that's rendered
    ```php
    $builder->add('text', TextareaType::class); 
    ```
5. Add a submit button to your form
    ```php
    $builder->add('sumbit', SubmitType::class)
    ```
6. Create a new Controller action and route for `createPost` (remember to inject the `Request`)
7. In your controller, create a new `Post`, bind it to the form and handle the requsett
    ```php
    $post = new Post();
    $form = $this->createForm(PostType::class, $post);
    $form->handleRequest($request)
    ```
8. Now create a new twig template 'create-post.html.twig' to render your form, you can render a form with:
    ```twig
    {{ form(form) }}
    ```
9. If the form hasn't been submitted, you need to render your new twig file
    ```php
    if (false === $form->isSubmitted() || false === $form->isValid()) {
       return $this->>render('create-post.html.twig', ['form' => $form->createView()]);
    }
    ```
10. Now you can load your page and look at the form
