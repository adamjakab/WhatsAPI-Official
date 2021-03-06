# WhatsAPI

Interface to WhatsApp Messenger

**Read the [wiki](https://github.com/mgp25/WhatsAPI-Official/wiki)** and previous issues before opeining a new one! Maybe your issue is already answered.

**[WhatsApp incoming updates log](https://github.com/mgp25/WhatsAPI-Official/wiki/WhatsApp-incoming-updates)**

----------

### Special thanks

I would like to thank all those who have made this project goes forward. First I have to thank [@shirioko](https://github.com/shirioko/) aka hero, when I came to the project, i knew nothing and introduced me to the project. He has been responsible of the API for a long time and he always be a hero! Now it's my turn and i hope to do as good as i can to make this API better.

And I also want to thank all the users that are collaborating with me and are making such good work:

- [pastoso](https://github.com/pastoso)
- [CODeRUS](https://github.com/CODeRUS)
- [GitsUp](https://github.com/GitsUp)
- [SikiFn](https://github.com/SikiFn)
- [Dennobaby](https://github.com/Dennobaby)
- [0xTryCatch](https://github.com/0xTryCatch)

[![Gratipay](http://img.shields.io/badge/Donate-Gratipay-brightgreen.svg)](https://gratipay.com/mgp25/) [![Paypal](https://www.paypalobjects.com/es_XC/i/btn/btn_donate_SM.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=me%40mgp25%2ecom&lc=US&item_name=WhatsAPI&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_SM%2egif%3aNonHosted)

**Bitcoin:** 15NejBDahfe1eLAPSJh4iMfYLHYuKDrwJ2


### Update October 7th, 2014

This is going to be the official repository of WhatsAPI. We don't support spam and we won't answer issues like "Blocking" or "sending massive messages".

**Latest updates**
- *Auto token updater: It uses a private server to generate token. When executing API it will check always for newest token, user agent and version.*
- *Identity generation has changed: Now is random_pseudo_bytes, in the WhatsApp object, the value you set in identity is the name of the file where the identity is going to be saved. I recommend to set as identity your phone number.*




### Update March 15th, 2014

Sources are back after brief downtime due to [DCMA takedown](https://github.com/github/dmca/blob/master/2014-02-12-WhatsApp.md).

### Note July 30th, 2013
*New policy:*

*I no longer provide support to users who are trying to send bulk messages using this API (i.e. a large amount of messages and not the built-in bulk message functionality).*
*Sending advertisments on WhatsApp goes directly against their EULA and I have no way of determining whether the user is trying to send spam, advertising or sending mass messages to "opt-in users".*
*And I also don't want to waste the little spare time that I have on trying to figure out ways to fuck up this beautiful ad-free platform called WhatsApp by enabling people to send spam.*
*Everyone is free to use this API but there will be no more issue reports about being blocked after sending messages to semi-random users.*

*In the famous words of Heath Ledger as the Joker (taken completely out of context by me):*

**It's not about the money, it's about sending a message.**

*\- [shirioko](https://github.com/shirioko)*

----------

### Note July 14th, 2013
*Events renamed:*
- *A large number of events have been renamed in the event handling system to better match the recent method names.*
- *All event names and parameters have been listed in the EVENTS.md file*


----------

### Note July 10th, 2013
*Another massive overhaul in the code:*
- *MAJOR RENAMING OF MOST METHODS!! Old legacy code will break, we are sorry but it is necessary to provide a cleaner interface. Please check the new code.*
- *Methods renamed to give a more consistent feel to the API - all methods are now camelCase watch out for typo's!*
- *Initial movement towards bringing the code into alignment with PSR-2 (http://www.php-fig.org/psr/2/)*
- *There is absolutely NO, NONE, NADA, ZIP, 100% FREE of any need to use/enter a MAC address or IMEI in this code. DO NOT TRY!*
- *[New Android token used](https://github.com/karolsarnacki/whatsapp/commit/55d8233b852ecd9f6a6f845586e91e6fadbd0c44#L1L20) as WP7 one appears to no longer work. Long live the WP7 token?*

----------


### Note June 18th, 2013

*Big overhaul in the code. Big thanks to:*
- *[Ali Hubail](https://github.com/hubail) and*
- *[Ahmed Moh'd](http://fb.com/ahmed.mhd) for making this project happen (and adding me as a member)*
- *[Jannik Vogel](https://github.com/JayFoxRox) for helping me retrieve the latest WhatsApp token, someone should write a book about it some day..*
- *[Tarek Galal](https://github.com/tgalal) for providing the latest WhatsApp functionality in yowsup*
- *[Atans](https://github.com/atans) and*
- *[Jonathan Williamson](https://github.com/jonnywilliamson) for additional fixes*

*\- [shirioko](https://github.com/shirioko)*


----------

### What is WhatsApp?
According to [the company](http://www.whatsapp.com/):

> “WhatsApp Messenger is a cross-platform mobile messenger that replaces SMS and works through the existing internet data plan of your device. WhatsApp is available for iPhone, BlackBerry, Android, Windows Phone, Nokia Symbian60 & S40 phones. Because WhatsApp Messenger uses the same internet data plan that you use for email and web browsing, there is no cost to message and stay in touch with your friends.”

Late 2011 numbers: 1 billion messages per day, ~20 million users.

### Modified XMPP
WhatsApp uses some sort of customized XMPP server, named internally as FunXMPP, which is basically some extended proprietary version.

### Login procedure
Much like XMPP, WhatsApp uses JID (jabber id) and password to successfully login to the service. The password is generated by the server and received upon registration.


The JID is a concatenation between your country’s code and mobile number.

Initial login uses Digest Access Authentication.

### Message sending
Messages are basically sent as TCP packets, following WhatsApp’s own format (unlike what’s defined in XMPP RFCs).

Messages are application level encrypted using RC4 keystreams

### Multimedia Message sending
Photos, Videos and Audio files shared with WhatsApp contacts are HTTP-uploaded to a server before being sent to the recipient(s) along with Base64 thumbnail of media file (if applicable) along with the generated HTTP link as the message body.

### Event system
WhatsApi uses an event manager (created by [facine](https://github.com/facine)) which allows you to respond to certain events.

List of events and example code on how to bind an event handler:
https://github.com/shirioko/WhatsAPI/wiki/WhatsApi-events

# FAQ


- **What’s with the hex chars floating all over the code?**

	Mostly WhatsApp’s proprietary control chars/commands, or formatted data according to their server’s specifications, stored in predefined dictionaries within the clients.

- **What’s your future development plans?**

	We don’t have any.

- **Would it run over the web?**

	We’ve tested a slightly-modified version on top of Tornado Web Server and worked like a charm, however, building a chat client is a bit tricky, do your research.

- **Can I receive chats?**

	Indeed, using the same socket-receiving mechanism. But you have to parse the incoming data. Parsing functions aren’t included in this release, maybe in the next one?

- **I think the code is messy.**

	It’s working.

- **How can I obtain my password?**

	Register a number using WhatsAPI or intercept your phone's password using MissVenom

# NOTES

- This proof of concept is extensible to contain every feature that make a fully-fledged client, similar to the official ones, actually could be even better.

- During the two weeks of analysis of service mechanisms, we stumbled upon serious design and security flaws (they fixed some of them since 2011). For a company with such massive user base, we expected better practises and engineering.

# License

MIT - refer to the source code for the extra line.

# Venomous

Team of Bahraini Developers.

Ahmed Moh'd ([fb.com/ahmed.mhd](https://www.facebook.com/ahmed.mhd)) and Ali Hubail ([@hubail](https://twitter.com/hubail)) contributed to this release.
