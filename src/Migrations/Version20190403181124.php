<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190403181124 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tipus_qi (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questions_internes (id INT AUTO_INCREMENT NOT NULL, tipus_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, fecha_alta DATETIME NOT NULL, INDEX IDX_90E33757898C381B (tipus_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE questions_internes ADD CONSTRAINT FK_90E33757898C381B FOREIGN KEY (tipus_id) REFERENCES tipus_qi (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE questions_internes DROP FOREIGN KEY FK_90E33757898C381B');
        $this->addSql('DROP TABLE tipus_qi');
        $this->addSql('DROP TABLE questions_internes');
    }
}
