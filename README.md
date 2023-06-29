# Установка Docker на сервер Ubuntu 22
```
sudo su
```
```
sudo apt update
```
```
sudo apt install apt-transport-https ca-certificates curl software-properties-common
```
```
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg
```
```
echo "deb [arch=$(dpkg --print-architecture) signed-by=/usr/share/keyrings/docker-archive-keyring.gpg] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
```
```
sudo apt update
```
```
apt-cache policy docker-ce
```
```
sudo apt install docker-ce
```
```
sudo systemctl status docker
```

# Установка docker-compose на сервер Ubuntu 22
```
mkdir -p ~/.docker/cli-plugins/
curl -SL https://github.com/docker/compose/releases/download/v2.3.3/docker-compose-linux-x86_64 -o ~/.docker/cli-plugins/docker-compose
```
```
chmod +x ~/.docker/cli-plugins/docker-compose
```
```
docker compose version
```

# Установка gitlab runner на сервер Ubuntu 22
```
sudo curl -L --output /usr/local/bin/gitlab-runner "https://gitlab-runner-downloads.s3.amazonaws.com/latest/binaries/gitlab-runner-linux-amd64"
```
```
sudo chmod +x /usr/local/bin/gitlab-runner
```
```
sudo useradd --comment 'GitLab Runner' --create-home gitlab-runner --shell /bin/bash
```
```
sudo gitlab-runner install --user=gitlab-runner --working-directory=/home/gitlab-runner
```
```
sudo rm -rf /etc/systemd/system/gitlab-runner.service
```
```
gitlab-runner install --user root
```

После этого создаем раннер на сайте гитлаб и выполним только 1-ый пункт на сайте потом:
```
gitlab-runner verify
```
```
gitlab-runner restart
```

Измените права доступа папки storage
```
cd builds/Q_01/0/builditkz/aparts_backend
sudo chmod 777 -R storage/
```


