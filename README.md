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

### Fetch list via API

Fetch date(json file name) from list API.

```
curl https://raw.githubusercontent.com/kura-lab/my-lives/master/events/list.json

[
  "20120716.json",
  "20120729.json",
  "20120812.json",
  ...
]
```

Put the date to following url suffix.

`https://raw.githubusercontent.com/kura-lab/my-lives/master/events/YYYYmmdd.json`

```
curl https://raw.githubusercontent.com/kura-lab/my-lives/master/events/20120716.json
```

### Response Format

Response sample is below.

```
{
  "event": "<event>",
  "date": "201x-xx-xx",
  "prefecture": "<prefecture>",
  "venues": "<venues>",
  "setlist": {
    "main": [
      [
        "<artist>",
        [
          "<song>",
          "<song>"
        ]
      ]
    ],
    "encore": [
      [
        "<artist>",
        [
          "<song>",
          "<song>"
        ]
      ]
    ]
  }
}
```
