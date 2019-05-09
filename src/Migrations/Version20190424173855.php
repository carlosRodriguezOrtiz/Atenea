<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190424173855 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE dafo_tipus_qe (id INT AUTO_INCREMENT NOT NULL, questio_externa_id INT DEFAULT NULL, id_dafo_id INT DEFAULT NULL, tipus VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_5E1D14B1B974A25F (questio_externa_id), INDEX IDX_5E1D14B11397BB9D (id_dafo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dafo (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dafo_tipus_qi (id INT AUTO_INCREMENT NOT NULL, questio_interna_id INT DEFAULT NULL, id_dafo_id INT DEFAULT NULL, tipus VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_57AB589A7C92792A (questio_interna_id), INDEX IDX_57AB589A1397BB9D (id_dafo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dafo_tipus_qe ADD CONSTRAINT FK_5E1D14B1B974A25F FOREIGN KEY (questio_externa_id) REFERENCES questions_externes (id)');
        $this->addSql('ALTER TABLE dafo_tipus_qe ADD CONSTRAINT FK_5E1D14B11397BB9D FOREIGN KEY (id_dafo_id) REFERENCES dafo (id)');
        $this->addSql('ALTER TABLE dafo_tipus_qi ADD CONSTRAINT FK_57AB589A7C92792A FOREIGN KEY (questio_interna_id) REFERENCES questions_internes (id)');
        $this->addSql('ALTER TABLE dafo_tipus_qi ADD CONSTRAINT FK_57AB589A1397BB9D FOREIGN KEY (id_dafo_id) REFERENCES dafo (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dafo_tipus_qe DROP FOREIGN KEY FK_5E1D14B11397BB9D');
        $this->addSql('ALTER TABLE dafo_tipus_qi DROP FOREIGN KEY FK_57AB589A1397BB9D');
        $this->addSql('DROP TABLE dafo_tipus_qe');
        $this->addSql('DROP TABLE dafo');
        $this->addSql('DROP TABLE dafo_tipus_qi');
    }
}
