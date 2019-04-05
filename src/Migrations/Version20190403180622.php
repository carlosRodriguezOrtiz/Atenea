<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190403180622 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE questions_externes (id INT AUTO_INCREMENT NOT NULL, tipus_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, fecha_alta DATETIME NOT NULL, fecha_baja DATETIME NOT NULL, INDEX IDX_C3428BEC898C381B (tipus_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_tipus_qe (id INT AUTO_INCREMENT NOT NULL, tipus_qe_id INT DEFAULT NULL, descripcion VARCHAR(255) NOT NULL, INDEX IDX_C63F7E8D6D8F41FE (tipus_qe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipus_qe (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE questions_externes ADD CONSTRAINT FK_C3428BEC898C381B FOREIGN KEY (tipus_id) REFERENCES tipus_qe (id)');
        $this->addSql('ALTER TABLE sub_tipus_qe ADD CONSTRAINT FK_C63F7E8D6D8F41FE FOREIGN KEY (tipus_qe_id) REFERENCES tipus_qe (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE questions_externes DROP FOREIGN KEY FK_C3428BEC898C381B');
        $this->addSql('ALTER TABLE sub_tipus_qe DROP FOREIGN KEY FK_C63F7E8D6D8F41FE');
        $this->addSql('DROP TABLE questions_externes');
        $this->addSql('DROP TABLE sub_tipus_qe');
        $this->addSql('DROP TABLE tipus_qe');
    }
}
