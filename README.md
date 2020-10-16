# TALL Magento

The aim for this project is to build a different frontend for Magento based on the TALL stack:

- [**T**ailwind](https://tailwindcss.com/)
- [**A**lpine.js](https://github.com/alpinejs/alpine)
- [**L**aravel](https://github.com/alpinejs/alpine)
- [**L**ivewire](https://laravel-livewire.com/)

It's the best of both worlds: The powerful backend of Magento, the flexible and easy to use Laravel framework. And the best part: Barely any javascript!

# Why?

There are already solutions out there: [DEITY Falcon](https://github.com/deity-io/falcon), [Vue Storefront](https://www.vuestorefront.io/) and offcource Magento's own [PWA Studio](https://github.com/magento/pwa-studio) for example. So why another one? There are a few reasons for that: First of all, did you ever try to get them up & running? You'll see it's not that simple, as the tech stack is completely different. They are all based on NodeJS, which is completely different from PHP and even Javascript. So you first need to learn that. Then you have to take a deep dive into Server Side Rendering and other techniques. 

Secondly, i love to work with Laravel, and i know a lot of fellow Magento developers do too. Laravel has lot in common with Magento, so it just makes a lot of sense.

# Barely any Javascript? How?

For a big part that credit goes to Livewire. See my Reaction talk for an in depth overview.  

# Is this production ready?

I've built mostly as a proof of concept if it could be done, but along the way a lot of things where going way easieer then expected (have your ever heard anyone say that about Magento?), so i've built way more around it than my original plan was. It's not running anywhere in production, but i wouldn't be surprised if it was capable of doing that.

# Are all options integrated that Magento offers?

No, currently there is support for these product types:

|Type|Integrated?|
|---|---|
|Simple|✅|
|Configurable|✅|
|Grouped|❌|
|Bundle|❌|
|Downloadable|❌|
|Virtual|❌|

These are the known features that are not supported (yet), but there are dozens of feature more that should be on this list:
- Separate billing and addresses
- Customer login, only guests are supported
- Customer pricing
- It's not responsive
- Probably loads and loads more features.

# The proof in the pudding

I did a quick screencast so you can get a grasp of what this entails:

[![TALL Magento presentation](https://img.youtube.com/vi/0upyB6NbLnc/0.jpg)](https://www.youtube.com/watch?v=0upyB6NbLnc)

You can check this out yourself at this URL:

[https://tall-magento.controlaltdelete.nl/](https://tall-magento.controlaltdelete.nl/)
