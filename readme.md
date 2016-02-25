# Demo application for Twilio-ug Osaka on February 27, 2016

[![Build Status](https://travis-ci.org/shin1x1/twilio-api-security-demo.svg?branch=master)](https://travis-ci.org/shin1x1/twilio-api-security-demo)

## Heroku setup

```
heroku apps:create shin1x1-twilio-security-demo

heroku buildpacks:add heroku/php
heroku addons:create papertrail:choklad
heroku addons:create deployhooks:http

heroku config:add DB_CONNECTION=sqlite
heroku config:add APP_ENV=heroku
heroku config:add APP_DEBUG=false
heroku config:add APP_KEY=xxxxxxxxxxxxxxxxxxxxx
```