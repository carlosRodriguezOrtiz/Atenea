<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190326185924 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE empresa ADD corporaciones_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE empresa ADD CONSTRAINT FK_B8D75A50CDCE378D FOREIGN KEY (corporaciones_id) REFERENCES corporacion (id)');
        $this->addSql('CREATE INDEX IDX_B8D75A50CDCE378D ON empresa (corporaciones_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE empresa DROP FOREIGN KEY FK_B8D75A50CDCE378D');
        $this->addSql('DROP INDEX IDX_B8D75A50CDCE378D ON empresa');
        $this->addSql('ALTER TABLE empresa DROP corporaciones_id');
    }
}
