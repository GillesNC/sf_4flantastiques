<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260218165701 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE flan (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, category VARCHAR(255) DEFAULT NULL, photo JSON DEFAULT NULL, bio LONGTEXT DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, avg_score NUMERIC(10, 0) DEFAULT NULL, reviews_count INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, archived_at DATETIME DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE flan');
    }
}
