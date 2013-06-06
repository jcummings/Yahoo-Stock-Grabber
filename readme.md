### Yahoo Finance historical stock price data scraper
This is a simple PHP script designed to be run at the command line to throw a list of stock ticker symbols at the Yahoo Finance website, and retrieve a CSV file for each ticker symbol provided of all historical pricing data for that stock since IPO.

#### Command Syntax
This script runs as a command line script (written for Windows, but it should be fairly adaptable for other OS environments) because with a large list of ticker symbols, you are likely to both unnecessarily tax your webserver, and run up against connection timeouts or buffer/memory limits if calling this via a web browser.

To run the script from the command line:
`[PATH to PHP.EXE]\php.exe getstock.php tickersymbolfile.ext Output\\directory\\path`

#### Output
Tickers symbol list should be a plain text list of all the tickers symbols you want to retrieve data from, with only one symbol on each line of the file.

The return contains all historical pricing for a given symbol through the date the company began public trading.

Data is returned is CSV format in a series of files named SYMBOL.CSV in the speficied diretory

#### Considerations
Make sure that the output directory you specify is writable by the process running your PHP executable, or you'll recieve a permission denied error.

This script should work with any number of ticker symbols provided, so long as you don't mind it taking some time to process. I have successfully tested with 5,000+ ticker symbols in a single file with success.