# Project 3
+ By: *Andrea Salkey*
+ Production URL: <http://e15p3.andrea.codes>

## Feature summary
+ Visitors can register/log in
+ Users create and participate in polls
+ Users can delete their own polls
+ Users can update their name and email in the profile
+ Each user has a public profile page which presents a short bio about their movie tastes, as well as a list of public movies in their collection
+ On the home page when logged in users can see all the polls they can participate in
+ Users can access a list of polls they participated in and view the results

## Database summary
+ My application has 3 tables in total (`users`, `results`, `polls`)
+ There's a one-to-many relationship between `users` and `polls`
+ There's a one-to-many relationship between `polls` and `results`
+ There's a one-to-many relationship between `users` and `results`

## Outside resources
laracasts
