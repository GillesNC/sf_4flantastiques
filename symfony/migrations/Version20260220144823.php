<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260220144823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, file JSON DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, path VARCHAR(255) DEFAULT NULL, size INT NOT NULL, created_at DATETIME DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE document_flan (document_id INT NOT NULL, flan_id INT NOT NULL, INDEX IDX_F9CDFADC33F7837 (document_id), INDEX IDX_F9CDFADEC97AB6F (flan_id), PRIMARY KEY (document_id, flan_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE document_spot (document_id INT NOT NULL, spot_id INT NOT NULL, INDEX IDX_1E86F6E0C33F7837 (document_id), INDEX IDX_1E86F6E02DF1D37C (spot_id), PRIMARY KEY (document_id, spot_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE document_flan ADD CONSTRAINT FK_F9CDFADC33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_flan ADD CONSTRAINT FK_F9CDFADEC97AB6F FOREIGN KEY (flan_id) REFERENCES flan (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_spot ADD CONSTRAINT FK_1E86F6E0C33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE document_spot ADD CONSTRAINT FK_1E86F6E02DF1D37C FOREIGN KEY (spot_id) REFERENCES spot (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE document_flan DROP FOREIGN KEY FK_F9CDFADC33F7837');
        $this->addSql('ALTER TABLE document_flan DROP FOREIGN KEY FK_F9CDFADEC97AB6F');
        $this->addSql('ALTER TABLE document_spot DROP FOREIGN KEY FK_1E86F6E0C33F7837');
        $this->addSql('ALTER TABLE document_spot DROP FOREIGN KEY FK_1E86F6E02DF1D37C');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE document_flan');
        $this->addSql('DROP TABLE document_spot');
    }
}
