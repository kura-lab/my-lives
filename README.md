# my-lives
It is a record of my live events.  
Artists and set lists are recorded in the file with JSON format.

### Preparation

At first, install composer and library.

```
$ curl -s http://getcomposer.org/installer | php
$ php composer.phar install
```

### Add event

copy template and edit event json file.

```
$ cp template.json events/<date>.json
$ vim events/<date>.json
```

### Sniff and Update list

At last, sniff the event json and update event list.

```
$ ./json-sniffer.php
$ ./list-generator.php
```
