<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220415090216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE singles ADD albums_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE singles ADD CONSTRAINT FK_7FAFC0ECECBB55AF FOREIGN KEY (albums_id) REFERENCES albums (id)');
        $this->addSql('CREATE INDEX IDX_7FAFC0ECECBB55AF ON singles (albums_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE singles DROP FOREIGN KEY FK_7FAFC0ECECBB55AF');
        $this->addSql('DROP INDEX IDX_7FAFC0ECECBB55AF ON singles');
        $this->addSql('ALTER TABLE singles DROP albums_id');
    }
}
