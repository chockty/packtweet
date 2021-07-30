CREATE TABLE retweet_tweet (
  retweet_id INT UNSIGNED,
  tweet_id INT UNSIGNED,
  PRIMARY KEY(retweet_id, tweet_id)
);