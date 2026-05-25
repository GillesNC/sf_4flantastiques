<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260226075519 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE flan ADD spot_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE flan ADD CONSTRAINT FK_A828533E2DF1D37C FOREIGN KEY (spot_id) REFERENCES spot (id)');
        $this->addSql('CREATE INDEX IDX_A828533E2DF1D37C ON flan (spot_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE flan DROP FOREIGN KEY FK_A828533E2DF1D37C');
        $this->addSql('DROP INDEX IDX_A828533E2DF1D37C ON flan');
        $this->addSql('ALTER TABLE flan DROP spot_id');
    }
}
