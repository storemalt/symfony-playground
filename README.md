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
