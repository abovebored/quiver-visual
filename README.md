Quiver Visual
=====

**An extension for [Quiver](https://itunes.apple.com/app/quiver-programmers-notebook/id866773894) by [Happen Apps](http://happenapps.com/)**

A small PHP app which lets you bowse your Quiver notes in visual way. It can live locally (run [MAMP](https://www.mamp.info/) or similar) or on a remote webserver - syncing with your Quiver library with your server via [Dropbox](http://dropbox.com) or [BitTorrent Sync](https://www.getsync.com/).

Issue reporting & pull requests welcome 🍺

_N.B. This project has no affiliation with or endorsement from Quiver or Happen Apps._

![Example of the app in use](screenshot.png)

## Installation 

Throw it at a PHP environment. It assumes the `Quiver.qvlibrary` file (or symlink to) is in the root, but this is configurable in [/lib/config.php](/lib/config.php).

## Example usages

- Share visiual inspiration with a client/3rd party.
- Run a visual blog from your Quiver app.
- Find visuals in your library quickly

## Roadmap

- [ ] UI customisation options (colour, typography, menu position etc.)
- [ ] Option to hide text only notes
- [x] Add image resizing, caching and compression
- [ ] Add shareable URLs
- [ ] Configure which notebooks to publish
- [ ] Responsive layout
- [ ] Examine feasability of allowing editing of the library 
- [ ] Tag pages
- [ ] Configurable views (user defined thumbnail size, sorting order, searching etc.)
