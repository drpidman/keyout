FROM mcr.microsoft.com/devcontainers/base:bullseye

RUN "echo \"deb https://packages.sury.org/php $(lsb_release -sc) main\"\
 | sudo tee /etc/apt/sources.list.d/sury-php.list"

RUN "wget -q0 - https://packages.sury.org/php/apt.gpg | sudo apt-key add -"

RUN "sudo apt update"

RUN "sudo apt install php8.3 && sudo apt install php8.3-mysql"