# BahmanSpider

Some useful APIs which made it easier to buy cars from BahmanMotor (Iranecar).

## Direct Link
This script can find direct access link to the form using circulation data. I suggest setting a corn-job to run this script at VERY FIRST MOMENT of registration process and use its result to have a faster registration.

Note: Setting of this script can be find in `config.php`

#### Configuration

* `car` Car ID to get links for (use below table)
* `botToken` Telegram Bot API token
* `channel` Telegram Chat ID to get links and messages 

| #   | Name     |
|-----|----------|
| 55 | B30 |
| 93 | Kara Dual Cabin  |
| 94 | Kara Single Cabin |
| **96** | **Dignity** |
| **100** | **Fidelity** |
| 104 | Capra 4DW |
| 106 | EmPower |

You can use ID Finder to expand your car ID list.

## ID Finder

We use this script to understand car ids and find new cars before their official registration. 

Set a cron-job for every 6-hour to check data.

## Forms

Simulated form of each registration is available at `test-forms/` directory.

* `new.php`: Tested at 1400/12/17 and works properly.
* `old.php`: Old Iranecar version. This file is invalid after 1400/10

## Queue Monitor

Are you stuck in the validation process? Just give your `queueId` and `orderId` to this script. It will keep sending request to the `CheckResult` endpoint until get payment link. (This script never stops working. needs manually terminate using `Ctrl+C`) 

## Home Checker

This script checks Bahman's home items and notifies you when home something is available to buy.

Example Usages:
* Finding test circulations
* Get notified when circulation published at sell days (example: sometimes they publish circulations at 10:03 instead of 10:00; and we can't refresh the website every 30 seconds)
