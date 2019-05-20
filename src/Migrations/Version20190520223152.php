<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190520223152 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aspecte_q DROP FOREIGN KEY FK_556D6A54861C8D0B');
        $this->addSql('ALTER TABLE aspecte_q DROP FOREIGN KEY FK_556D6A54A6B6EE63');
        $this->addSql('DROP INDEX IDX_556D6A54A6B6EE63 ON aspecte_q');
        $this->addSql('DROP INDEX IDX_556D6A54861C8D0B ON aspecte_q');
        $this->addSql('ALTER TABLE aspecte_q ADD questio_externa_id INT DEFAULT NULL, ADD questio_interna_id INT DEFAULT NULL, DROP questions_externes_id, DROP questions_internes_id');
        $this->addSql('ALTER TABLE aspecte_q ADD CONSTRAINT FK_556D6A54B974A25F FOREIGN KEY (questio_externa_id) REFERENCES questions_externes (id)');
        $this->addSql('ALTER TABLE aspecte_q ADD CONSTRAINT FK_556D6A547C92792A FOREIGN KEY (questio_interna_id) REFERENCES questions_internes (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_556D6A54B974A25F ON aspecte_q (questio_externa_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_556D6A547C92792A ON aspecte_q (questio_interna_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE aspecte_q DROP FOREIGN KEY FK_556D6A54B974A25F');
        $this->addSql('ALTER TABLE aspecte_q DROP FOREIGN KEY FK_556D6A547C92792A');
        $this->addSql('DROP INDEX UNIQ_556D6A54B974A25F ON aspecte_q');
        $this->addSql('DROP INDEX UNIQ_556D6A547C92792A ON aspecte_q');
        $this->addSql('ALTER TABLE aspecte_q ADD questions_externes_id INT DEFAULT NULL, ADD questions_internes_id INT DEFAULT NULL, DROP questio_externa_id, DROP questio_interna_id');
        $this->addSql('ALTER TABLE aspecte_q ADD CONSTRAINT FK_556D6A54861C8D0B FOREIGN KEY (questions_externes_id) REFERENCES questions_externes (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE aspecte_q ADD CONSTRAINT FK_556D6A54A6B6EE63 FOREIGN KEY (questions_internes_id) REFERENCES questions_internes (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_556D6A54A6B6EE63 ON aspecte_q (questions_internes_id)');
        $this->addSql('CREATE INDEX IDX_556D6A54861C8D0B ON aspecte_q (questions_externes_id)');
    }
}
