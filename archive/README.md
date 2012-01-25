# recordable

Simple phone conversation recording, anywhere, anytime!


## Requirements

Recordable is a small web application that allows you to record a phone conversation and later retrieve that conversation using the website.


## Installation

This service is designed to be run on a PHP webserver. The scripts and configuration files cannot be run from a local desktop environment.

Phone call and text message functionality is provided by the Twilio service. To run this application on your own server, you will need access to the Twilio API and a phone number attached to your Twilio account.


## Usage

This service is self-sustaining, meaning that once the scripts and configuration files are loaded on the webserver, no additional maintenance or overhead is necessary.

A cron job is needed to ping the application to check for reminders that are ready for delivery.


## Disclaimer

Use this service at your own risk. While these scripts has been tested thoroughly, on the above requirements, your mileage may vary. I take no responsibility for any harmful actions this service might cause.


## License

This software, and its dependencies, are distributed free of charge and licensed under the GNU General Public License v3. For more information about this license and the terms of use of this software, please review the LICENSE.txt file.
