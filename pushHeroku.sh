git push heroku master
heroku run npm i &&  npm run dev
heroku run composer update
heroku run composer dump-autoload
