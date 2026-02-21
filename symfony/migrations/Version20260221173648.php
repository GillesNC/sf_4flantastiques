<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260221173648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, photo_id INT DEFAULT NULL, INDEX IDX_2D5B02347E9E4C8C (photo_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B02347E9E4C8C FOREIGN KEY (photo_id) REFERENCES document (id)');
        $this->addSql('ALTER TABLE spot ADD city_id INT NOT NULL, DROP city, CHANGE photo photo JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE spot ADD CONSTRAINT FK_B9327A738BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_B9327A738BAC62AF ON spot (city_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B02347E9E4C8C');
        $this->addSql('DROP TABLE city');
        $this->addSql('ALTER TABLE spot DROP FOREIGN KEY FK_B9327A738BAC62AF');
        $this->addSql('DROP INDEX IDX_B9327A738BAC62AF ON spot');
        $this->addSql('ALTER TABLE spot ADD city VARCHAR(255) DEFAULT NULL, DROP city_id, CHANGE photo photo VARCHAR(255) DEFAULT NULL');
    }
}
