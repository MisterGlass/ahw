# Installation
See INSTALL.md

# Usage
The server should be exposed at https://localhost:8080. Note that you will need to add an exception for the self signed certificate you created above.

The upload form is located at https://localhost:8080/uploadform. You will be required to log in, the fixtures created an account for the email `data@theatlantic.com` with a password of `p@ssword`

You can access the database directly on port 5000

# Notes
Unfortunately I ran out of time, before I could add proper error handling and tests.

I also would like to refactor the upload controller a bit:
 - Move the tempDirectory method to a class variable set in the constructor
 - Use a safer method to parse the TSV (it works with the sample but is not robust)
 - Relocate the importPurchaseEvent method to a model class.

After that, I would probably make the templates nicer, and add a bit more output to the user on what happened during import (maybe counts of each new user, product, and event).
