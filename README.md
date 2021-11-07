# minimal-blog

## blua.blue webhook POC

This little repo can be run either with node or PHP and serves as a proof of concept for blua.blue based blogs without using the API or SDKs.
Both the PHP-version and the node-version are based on a total of less than 75 lines of code. The PHP version is even completely free of dependencies.

The goal of this project is was to create the easiest possible setup to host your own blog.


See it here:
https://equinox-vivacious-havarti.glitch.me/

## How to use

1. If you don't have an account, sign up at [blua.blue](https://blua.blue)
2. Clone, fork or download this repo and host it depending on your needs*
3. Set up webhooks on blua.blue
  - PHP-endpoint: `https://your-site.com/receive.php`
  - node-endpoint: `https://your-site.com/receive`

_*Be careful of hosting via services like heroku: many of these services delete files written to the file-system after some idle time_

That's it. Enjoy
