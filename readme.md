[![CodeFactor](https://www.codefactor.io/repository/github/laanito/redmine_file_api/badge/master)](https://www.codefactor.io/repository/github/laanito/redmine_file_api/overview/master)

[![phpci](http://cipulsia.pulsia.es/build-status/image/6)](http://cipulsia.pulsia.es/build-status/view/6)


## API ODF Redmine

This code offers an API to download files from Redmine with the following answers:

    401 <- Authorization failure (redirects to custom login page)
    404 <- File not found if file is not in the system
    200 <- Ok and file download if all is correct
    500 <- Server Error Otherwise 
    
This can be easily deployed using the Dockerfile attached, just change your server url on LibRedmine file