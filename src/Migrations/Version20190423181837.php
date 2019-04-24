<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190423181837 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE questions_externas DROP FOREIGN KEY FK_A72E4EE8A9276E6C');
        $this->addSql('ALTER TABLE sub_tipo_qe DROP FOREIGN KEY FK_23E39A5791D4BFB9');
        $this->addSql('CREATE TABLE dafo_tipus_qi (id INT AUTO_INCREMENT NOT NULL, questio_interna_id INT DEFAULT NULL, id_dafo_id INT DEFAULT NULL, tipus VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_57AB589A7C92792A (questio_interna_id), INDEX IDX_57AB589A1397BB9D (id_dafo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questions_externes (id INT AUTO_INCREMENT NOT NULL, tipus_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, fecha_alta DATETIME NOT NULL, fecha_baja DATETIME NOT NULL, INDEX IDX_C3428BEC898C381B (tipus_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipus_qe (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dafo (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dafo_tipus_qe (id INT AUTO_INCREMENT NOT NULL, questio_externa_id INT DEFAULT NULL, id_dafo_id INT DEFAULT NULL, tipus VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_5E1D14B1B974A25F (questio_externa_id), INDEX IDX_5E1D14B11397BB9D (id_dafo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_tipus_qe (id INT AUTO_INCREMENT NOT NULL, tipus_qe_id INT DEFAULT NULL, descripcion VARCHAR(255) NOT NULL, INDEX IDX_C63F7E8D6D8F41FE (tipus_qe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questions_internes (id INT AUTO_INCREMENT NOT NULL, tipus_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL, fecha_alta DATETIME NOT NULL, INDEX IDX_90E33757898C381B (tipus_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipus_qi (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dafo_tipus_qi ADD CONSTRAINT FK_57AB589A7C92792A FOREIGN KEY (questio_interna_id) REFERENCES questions_internes (id)');
        $this->addSql('ALTER TABLE dafo_tipus_qi ADD CONSTRAINT FK_57AB589A1397BB9D FOREIGN KEY (id_dafo_id) REFERENCES dafo (id)');
        $this->addSql('ALTER TABLE questions_externes ADD CONSTRAINT FK_C3428BEC898C381B FOREIGN KEY (tipus_id) REFERENCES tipus_qe (id)');
        $this->addSql('ALTER TABLE dafo_tipus_qe ADD CONSTRAINT FK_5E1D14B1B974A25F FOREIGN KEY (questio_externa_id) REFERENCES questions_externes (id)');
        $this->addSql('ALTER TABLE dafo_tipus_qe ADD CONSTRAINT FK_5E1D14B11397BB9D FOREIGN KEY (id_dafo_id) REFERENCES dafo (id)');
        $this->addSql('ALTER TABLE sub_tipus_qe ADD CONSTRAINT FK_C63F7E8D6D8F41FE FOREIGN KEY (tipus_qe_id) REFERENCES tipus_qe (id)');
        $this->addSql('ALTER TABLE questions_internes ADD CONSTRAINT FK_90E33757898C381B FOREIGN KEY (tipus_id) REFERENCES tipus_qi (id)');
        $this->addSql('DROP TABLE questions_externas');
        $this->addSql('DROP TABLE sub_tipo_qe');
        $this->addSql('DROP TABLE tipo_qe');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dafo_tipus_qe DROP FOREIGN KEY FK_5E1D14B1B974A25F');
        $this->addSql('ALTER TABLE questions_externes DROP FOREIGN KEY FK_C3428BEC898C381B');
        $this->addSql('ALTER TABLE sub_tipus_qe DROP FOREIGN KEY FK_C63F7E8D6D8F41FE');
        $this->addSql('ALTER TABLE dafo_tipus_qi DROP FOREIGN KEY FK_57AB589A1397BB9D');
        $this->addSql('ALTER TABLE dafo_tipus_qe DROP FOREIGN KEY FK_5E1D14B11397BB9D');
        $this->addSql('ALTER TABLE dafo_tipus_qi DROP FOREIGN KEY FK_57AB589A7C92792A');
        $this->addSql('ALTER TABLE questions_internes DROP FOREIGN KEY FK_90E33757898C381B');
        $this->addSql('CREATE TABLE questions_externas (id INT AUTO_INCREMENT NOT NULL, tipo_id INT DEFAULT NULL, nombre VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, fecha_alta DATETIME NOT NULL, descripcion VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_A72E4EE8A9276E6C (tipo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sub_tipo_qe (id INT AUTO_INCREMENT NOT NULL, tipo_qe_id INT DEFAULT NULL, descripcion VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_23E39A5791D4BFB9 (tipo_qe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tipo_qe (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE questions_externas ADD CONSTRAINT FK_A72E4EE8A9276E6C FOREIGN KEY (tipo_id) REFERENCES tipo_qe (id)');
        $this->addSql('ALTER TABLE sub_tipo_qe ADD CONSTRAINT FK_23E39A5791D4BFB9 FOREIGN KEY (tipo_qe_id) REFERENCES tipo_qe (id)');
        $this->addSql('DROP TABLE dafo_tipus_qi');
        $this->addSql('DROP TABLE questions_externes');
        $this->addSql('DROP TABLE tipus_qe');
        $this->addSql('DROP TABLE dafo');
        $this->addSql('DROP TABLE dafo_tipus_qe');
        $this->addSql('DROP TABLE sub_tipus_qe');
        $this->addSql('DROP TABLE questions_internes');
        $this->addSql('DROP TABLE tipus_qi');
    }
}
