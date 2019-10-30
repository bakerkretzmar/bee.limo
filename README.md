bee.limo
========

[![Build](https://github.com/bakerkretzmar/bee.limo/workflows/CI/badge.svg)](https://github.com/bakerkretzmar/bee.limo/actions)
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg?style=flat)](https://opensource.org/licenses/MIT)

A word game based on [Spelling Bee](https://www.nytimes.com/puzzles/spelling-bee) from _The New York Times_ crossword—and when I say “based on,” I mean it’s an exact copy of that game. I built it as a learning exercise, please don’t sue me.

Built with Laravel, Svelte, and Tailwind.

Play at [bee.limo](https://bee.limo).

#### Todo

- [x] Fun about page with ~~stats and~~ links out to where I got stuff from
- [x] Say what tools it's built with
- [x] Let people make an account
- [x] ~~Save current puzzle state in local storage, but let people clear it~~ Let people play without being signed in
- [x] Tune puzzle solver
    - [x] Only 2 vowels
    - [x] No ‘S’
    - [x] Rethink ideal maximum/minimum words
    - [x] Build a real scoring system based on word length
- [x] Find a better word list!?
- [ ] **Make the 'sign in to save your progress' link save the progress in the session and redirect back, with it, after a sign in**
