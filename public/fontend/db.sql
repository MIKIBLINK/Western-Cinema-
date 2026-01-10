-- User authentication
SELECT user_id, username, password_hash, role, is_active 
FROM users 
WHERE username = ?;
-- Get paginated news list with category info
SELECT n.news_id, n.title, n.slug, n.excerpt, n.featured_image, 
       n.published_at, n.views,
       c.name AS category_name, c.slug AS category_slug,
       u.username AS author_name
FROM news n
JOIN categories c ON n.category_id = c.category_id
JOIN users u ON n.author_id = u.user_id
WHERE n.status = 'published'
ORDER BY n.published_at DESC
LIMIT 10 OFFSET 0;
-- Get full news article with tags
SELECT n.*, 
       c.name AS category_name, c.slug AS category_slug,
       u.username AS author_name, u.full_name AS author_full_name,
       GROUP_CONCAT(t.name) AS tags
FROM news n
JOIN categories c ON n.category_id = c.category_id
JOIN users u ON n.author_id = u.user_id
LEFT JOIN news_tags nt ON n.news_id = nt.news_id
LEFT JOIN tags t ON nt.tag_id = t.tag_id
WHERE n.slug = ?
GROUP BY n.news_id;
-- Get full news article with tags
SELECT n.*, 
       c.name AS category_name, c.slug AS category_slug,
       u.username AS author_name, u.full_name AS author_full_name,
       GROUP_CONCAT(t.name) AS tags
FROM news n
JOIN categories c ON n.category_id = c.category_id
JOIN users u ON n.author_id = u.user_id
LEFT JOIN news_tags nt ON n.news_id = nt.news_id
LEFT JOIN tags t ON nt.tag_id = t.tag_id
WHERE n.slug = ?
GROUP BY n.news_id;
-- Get all categories with news count
SELECT c.*, COUNT(n.news_id) AS news_count
FROM categories c
LEFT JOIN news n ON c.category_id = n.category_id AND n.status = 'published'
GROUP BY c.category_id
ORDER BY c.name;

-- Get approved comments for a news article
SELECT c.*, 
       IFNULL(u.username, c.author_name) AS display_name,
       IFNULL(u.full_name, c.author_name) AS full_name
FROM comments c
LEFT JOIN users u ON c.user_id = u.user_id
WHERE c.news_id = ? AND c.is_approved = TRUE
ORDER BY c.created_at ASC;
-- Database Optimization Recommendations
CREATE INDEX idx_news_slug ON news(slug);
CREATE INDEX idx_news_status ON news(status);
CREATE INDEX idx_news_category ON news(category_id);
CREATE INDEX idx_comments_news ON comments(news_id);
-- Database Optimization Recommendations
ALTER TABLE news ADD FULLTEXT(title, content, excerpt);
-- Search query:
SELECT * FROM news 
WHERE MATCH(title, content, excerpt) AGAINST('search term' IN NATURAL LANGUAGE MODE);
Partitioning (for large datasets):
-- Consider partitioning news table by date for large sites
ALTER TABLE news PARTITION BY RANGE (YEAR(published_at)) (
    PARTITION p2023 VALUES LESS THAN (2024),
    PARTITION p2024 VALUES LESS THAN (2025),
    PARTITION pmax VALUES LESS THAN MAXVALUE
);

-- Create Tables


-- Create the database
CREATE DATABASE IF NOT EXISTS news_portal;
USE news_portal;

-- Users table for authentication
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    full_name VARCHAR(100),
    role ENUM('admin', 'editor', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    is_active BOOLEAN DEFAULT TRUE,
    INDEX idx_username (username),
    INDEX idx_email (email)
);

-- Categories table
CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    slug VARCHAR(60) NOT NULL UNIQUE,
    description TEXT,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(user_id) ON DELETE SET NULL,
    INDEX idx_slug (slug)
);

-- Tags table
CREATE TABLE tags (
    tag_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    slug VARCHAR(60) NOT NULL UNIQUE,
    INDEX idx_tag_slug (slug)
);

-- News articles table
CREATE TABLE news (
    news_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(300) NOT NULL UNIQUE,
    content LONGTEXT NOT NULL,
    excerpt VARCHAR(300),
    category_id INT,
    featured_image VARCHAR(255),
    author_id INT NOT NULL,
    status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
    published_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    views INT DEFAULT 0,
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE SET NULL,
    FOREIGN KEY (author_id) REFERENCES users(user_id) ON DELETE CASCADE,
    INDEX idx_news_slug (slug),
    INDEX idx_news_status (status),
    INDEX idx_news_category (category_id),
    INDEX idx_published_at (published_at),
    FULLTEXT INDEX ft_news_content (title, content, excerpt)
);

-- News-tags relationship table
CREATE TABLE news_tags (
    news_id INT,
    tag_id INT,
    PRIMARY KEY (news_id, tag_id),
    FOREIGN KEY (news_id) REFERENCES news(news_id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(tag_id) ON DELETE CASCADE
);

-- Comments table
CREATE TABLE comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    news_id INT NOT NULL,
    user_id INT,
    parent_id INT NULL,
    content TEXT NOT NULL,
    author_name VARCHAR(100),
    author_email VARCHAR(100),
    is_approved BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (news_id) REFERENCES news(news_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL,
    FOREIGN KEY (parent_id) REFERENCES comments(comment_id) ON DELETE CASCADE,
    INDEX idx_comments_news (news_id),
    INDEX idx_comments_approved (is_approved)
);

-- Optional: Settings table for site configuration
CREATE TABLE settings (
    setting_id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(50) NOT NULL UNIQUE,
    setting_value TEXT,
    setting_group VARCHAR(30),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Optional: User sessions table
CREATE TABLE user_sessions (
    session_id VARCHAR(128) PRIMARY KEY,
    user_id INT NOT NULL,
    ip_address VARCHAR(45),
    user_agent TEXT,
    payload TEXT,
    last_activity TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    INDEX idx_user_sessions (user_id)
);

CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    slug VARCHAR(60) NOT NULL UNIQUE,
    description TEXT,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(user_id)
);

CREATE TABLE news (
    news_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(300) NOT NULL UNIQUE,
    content LONGTEXT NOT NULL,
    excerpt VARCHAR(300),
    category_id INT,
    featured_image VARCHAR(255),
    author_id INT NOT NULL,
    status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
    published_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    views INT DEFAULT 0,
    FOREIGN KEY (category_id) REFERENCES categories(category_id),
    FOREIGN KEY (author_id) REFERENCES users(user_id)
);

CREATE TABLE tags (
    tag_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    slug VARCHAR(60) NOT NULL UNIQUE
);

CREATE TABLE news_tags (
    news_id INT,
    tag_id INT,
    PRIMARY KEY (news_id, tag_id),
    FOREIGN KEY (news_id) REFERENCES news(news_id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(tag_id) ON DELETE CASCADE
);

INSERT INTO `users` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `address`, `phone`, `role`, `created_at`, `updated_at`) VALUES (NULL, 'saven', 'saven@gmail.com', '96738891b3e08f7e2238e1365b6252d3', 'Saven', 'Kry', 'BB', '08772343434', 'admin', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);