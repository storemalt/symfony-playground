# -*- mode: ruby -*-
# vi: set ft=ruby :

$script = <<SCRIPT

sudo phpdismod xdebug; sudo service php7.2-fpm restart #xoff
cd /srv/www/app/current
php composer.phar install
SCRIPT

# To add a the box, either build it from the daysailer repo, or get it from someone who did, then run:
# $ vagrant box add banshee.box --name banshee --force

Vagrant.configure("2") do |config|
  config.vm.box = "banshee"
  config.vm.hostname = "symfony.local"

  config.vm.network "private_network", ip: "10.2.0.2"
  config.vm.synced_folder "./", "/srv/www/app/current", type: "nfs", mount_options: ["tcp", "actimeo=2"]
  config.vm.provision "shell", inline: $script, privileged: false

  config.vm.provider "virtualbox" do |vb|
    vb.name = "symfony-playground"
    vb.memory = 1024
  end

end
