<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260316070126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mag (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, catÃegory VARCHAR(255) DEFAULT NULL, content LONGTEXT DEFAULT NULL, status VARCHAR(150) NOT NULL, create_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, user_id INT DEFAULT NULL, INDEX IDX_107E2F7CA76ED395 (user_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE mag_document (mag_id INT NOT NULL, document_id INT NOT NULL, INDEX IDX_7FE926C09E0B3042 (mag_id), INDEX IDX_7FE926C0C33F7837 (document_id), PRIMARY KEY (mag_id, document_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE mag ADD CONSTRAINT FK_107E2F7CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE mag_document ADD CONSTRAINT FK_7FE926C09E0B3042 FOREIGN KEY (mag_id) REFERENCES mag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mag_document ADD CONSTRAINT FK_7FE926C0C33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mag DROP FOREIGN KEY FK_107E2F7CA76ED395');
        $this->addSql('ALTER TABLE mag_document DROP FOREIGN KEY FK_7FE926C09E0B3042');
        $this->addSql('ALTER TABLE mag_document DROP FOREIGN KEY FK_7FE926C0C33F7837');
        $this->addSql('DROP TABLE mag');
        $this->addSql('DROP TABLE mag_document');
    }
}
