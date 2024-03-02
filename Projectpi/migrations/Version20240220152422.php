<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220152422 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE remorquage ADD lieu_accident_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE remorquage ADD CONSTRAINT FK_B11A8CE5DA814898 FOREIGN KEY (lieu_accident_id) REFERENCES accident (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B11A8CE5DA814898 ON remorquage (lieu_accident_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE remorquage DROP FOREIGN KEY FK_B11A8CE5DA814898');
        $this->addSql('DROP INDEX UNIQ_B11A8CE5DA814898 ON remorquage');
        $this->addSql('ALTER TABLE remorquage DROP lieu_accident_id');
    }
}
