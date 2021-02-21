CREATE TABLE `user` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(255),
  `title` varchar(5),
  `first_name` varchar(255),
  `last_name` varchar(255),
  `email` varchar(255),
  `email_verified` int,
  `password` varchar(255),
  `phone` int,
  `company` varchar(255),
  `prime_member` int,
  `email_notifications` int,
  `deals_notifications` int,
  `sms_notifications` int,
  `registered` timestamp,
  `access` int,
  `hash` varchar(255)
);

CREATE TABLE `message` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `subject` varchar(255),
  `content` varchar(255),
  `sent` timestamp,
  `sender_del` int,
  `recipient_del` int
);

CREATE TABLE `address` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `deliver_to` varchar(255),
  `address` varchar(255),
  `city` varchar(255),
  `province` varchar(255),
  `zip_code` varchar(255),
  `country` varchar(255)
);

CREATE TABLE `delivery` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `address_id` int,
  `user_id` int,
  `delivery_date` timestamp
);

CREATE TABLE `delivery_status` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `delivery_id` int,
  `status` int,
  `d_date` timestamp
);

CREATE TABLE `notification` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `type` int,
  `method` int,
  `content` varchar(255),
  `read` int,
  `sent` timestamp
);

CREATE TABLE `account_recovery` (
  `id` int,
  `email` varchar(255),
  `requests` int,
  `slug` varchar(255),
  `request_date` timestamp
);

ALTER TABLE `message` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `address` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

ALTER TABLE `address` ADD FOREIGN KEY (`id`) REFERENCES `delivery` (`address_id`);

ALTER TABLE `delivery_status` ADD FOREIGN KEY (`delivery_id`) REFERENCES `delivery` (`id`);

ALTER TABLE `user` ADD FOREIGN KEY (`id`) REFERENCES `delivery` (`user_id`);

ALTER TABLE `account_recovery` ADD FOREIGN KEY (`email`) REFERENCES `user` (`email`);

ALTER TABLE `notification` ADD FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
