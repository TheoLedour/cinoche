<?php

namespace App\Controller;

use App\Service\MarkdownHelper;
use Nexy\Slack\Client;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;

class ArticleController extends AbstractController
{
    /**
     * Currently unused: just showing a controller with a constructor!
     */
    private $isDebug;

    public function __construct(bool $isDebug)
    {
        $this->isDebug = $isDebug;
    }

    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage()
    {
        return $this->render('article/homepage.html.twig');
    }

    /**
     * @Route("/news/{slug}", name="article_show")
     */
    public function show($slug, MarkdownHelper $markdownHelper, Client $slack)
    {
        if ($slug === 'gandalf') {
            $message = $slack->createMessage()
                ->from('Gandalf')
                ->withIcon(':ghost:')
                ->setText('YOU SHALL NOT SLACK !');
            $slack->sendMessage($message);
        }

        $comments = [
            'Je me suis endormi tellement jai trouvé le film long. Ta critique est parfaite.',
            'quest ce quil se passe à la fin du film, Rama se fait tuer par le japonais?',
            'Je tinvite à lire ma critique sur ce même film',
        ];

        $articleContent = <<<EOF
Gareth Evans, ce "rookie" s'opposait à des crapules aussi ignobles que puissantes constituant une menace permanente et tangible, d'autant plus que ces dernières étaient aidées par une armée de sbires increvables. Enfin, il y avait une gradation de la violence et de l'intensité des combats qui menait à un climax complètement fou et furieux. Le pari avait été relevé avec brio et l'engouement n'en avait été que plus grand, notamment au regard du "minimalisme" volontaire de l'intrigue. Grace à une bonne campagne promotionnelle et à une suite d'avant-premières en festivals qui lui avait conféré une réputation plus qu'honorable, The Raid est devenu l'un des succès surprise de l'année 2012. Enthousiasmé par cet accueil et pouvant dorénavant bénéficier d'un budget supérieur pour son prochain film, Evans annonça rapidement qu'il souhaitait réaliser une suite en reprenant l'histoire d'un ancien projet qu'il avait dû abandonné car étant beaucoup trop cher à monter à l'époque. Voulant mettre les petits plats dans les grands, le cinéaste révéla qu'il entendait étendre le concept à tout un quartier. De quoi laisser rêveur quant au potentiel de ce second épisode.

Cette suite a été accueillie avec une ferveur similaire. Et sur le papier, les promesses étaient alléchantes : le héros devait affronter une mafia toute entière dans le cadre élargi d'une ville. Le film prenait l'allure d'un long métrage choral avec une flopée de nouveaux personnages et une histoire s'étendant sur plusieurs mois là où The Raid se déroulait presque en temps réel (ce qui renforçait le sentiment d'urgence que l'on éprouvait). Nul doute que le spectacle allait être au rendez-vous ! Néanmoins, une fois le film terminé, il est difficile de masquer sa déception tant une poignée d'idées de génie se retrouve noyée au sein d'un agrégat de choix préjudiciables. La première erreur du film est étonnemment d'avoir voulu être ambitieux. En doublant quasiment sa durée, The Raid 2 ne parvient pas à tenir son concept et se retrouve obligé de l'étirer inutilement. De plus, pris d'une bouffée de mégalomanie, Evans a souhaité que cette suite arbore la densité du Parrain de Francis F. Coppola. N'ayant pas encore le talent nécessaire pour maîtriser un récit aussi ample, il s'est contenté - pour faire illusion - de créer pleins de personnages pas forcément utiles dans la narration afin de justifier la guerre de gangs dans laquelle se retrouve le héros.

Paradoxalement, Evans a beau rajouter des gangsters, son histoire demeure d'une simplicité et d'une prévisibilité si désarmantes qu'elles ne justifient jamais qu'on l'ait étendue sur cent cinquante laborieuses minutes. The Raid 2 raconte ainsi moins de choses que son prédecesseur qui ne perdait pas son temps à justifier son concept pour ne pouvoir ensuite l'utiliser que superficiellement. Pire encore, il le fait moins bien. On pouvait pinailler sur certains détails de mise en scène dans The Raid, mais on les excusait par les restrictions budgétaires auxquelles Evans avait dû faire face. Avec ce second épisode, Evans a pourtant pu s'accorder davantage de libertés. De toute évidence, la photographie est plus travaillée et est par conséquent infiniment plus élégante. Le cinéaste s'éclate aussi à orchestrer des plans séquences régulièrement sidérants. Mais le caractère ampoulé de l'ensemble du long métrage fait apparaitre ces coups d'éclat comme des paris de mise en scène n'ayant d'autre objectif que de satisfaire l'ego d'un réalisateur fou de joie devant la preuve sans cesse renouvelée de ses indéniables capacités de technicien. Les images servent donc moins à raconter une histoire qu'à montrer l'étendue du talent d'Evans qui, malheureusement, se laisse occasionnellement à recopier ce qui a été fait ailleurs au lieu de s'en démarquer. Son The Raid 2 ressemble à s'y méprendre à une relecture interminable du Only God Forgives de Nicolas Winding Refn qui serait intégralement dénuée de sa force d'évocation et de sa symbolique psychanalytique. Ici, les ralentis ne sont plus que poseurs et ne servent que très occasionnellement à iconiser un personnage (souvent moins mémorable que ceux du premier épisode) quand il ne détonne pas complètement avec la nervosité des scènes d'action.

A ce titre, The Raid 2 s'avère plus avare que le film précédent en terme de spectacle. Et ce n'est malheureusement pas une fausse impression dûe à la plus longue durée du long métrage : il y a moins d'action que dans The Raid malgré la supériorité des moyens mis en place. Si une séquence de bagarre générale dans une prison sert d'amuse-bouche efficace, il faut attendre une heure et demie pour voir débarquer la première scène d'action qui se serve des spécificités de ce nouveau décor urbain mais qui soit aussi (enfin !) au niveau de celles du premier The Raid. Tout ce qui précède n'est qu'une mise en place bavarde visant à justifier une guerre mafieuse que le spectateur préfèrerait voir plutôt que d'attendre qu'elle se décide à débuter. C'est à partir de là que l'unique méchant ayant l'étoffe des psychopathes du premier épisode apparait : Hammer Girl. Elle et son compagnon armé d'une batte de baseball amènent des éclats gores et des combats plus graphiques qui se démarque judicieusement des autres duels à mains nues.

On retiendra donc surtout un massacre dans une rame de métro et une poursuite de voitures dont la maestria n'est pas sans rappeler celle du sud-coréen Kim Jee-woon lors de l'effarante séquence du taxi dans le ténébreux J'ai rencontré le Diable. Les vingt dernières minutes ne sacrifient pas la barbarie qui animait The Raid et met en scène une véritable boucherie qui, si elle est aussi violente que réjouissante, ne bénéficie cependant plus de l'effet de surprise dont disposait le premier opus. D'autant que Gareth Evans cesse à nouveau d'employer cet environnement urbain qui était supposé servir de cadre central à ce second épisode, pour livrer une version condensée du parcours de Rama lors de son premier raid. Parce qu'il est dorénavant plus expérimenté, Rama apparait régulièrement sûr de lui et il devient ardu de s'inquiéter sur son sort tant il n'est jamais vraiment inquiété malgré les coups qu'il reçoit. Cependant, l'acteur Iko Uwais se donne à fond et a clairement la carrure d'une "action star" crédible bien qu'il se perde de temps à autres dans ce fatras de sous-intrigues. Ca et là, Evans essaye de tordre l'image de son héros par de maladroites - mais finalement salutaires - saynetes dans lesquelles il se retrouve obligé d'agir en dehors des lois pour survivre. Mais cela ne suffit pas à élever le long métrage et il n'y a plus qu'à espérer que la dernière réplique soit la note d'intention de son cinéaste au vu de la diamétrale baisse qualitative entre ces deux "raids".
EOF;

        $articleContent = $markdownHelper->parse($articleContent);

        return $this->render('article/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
            'slug' => $slug,
            'comments' => $comments,
            'articleContent' => $articleContent,
        ]);
    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"})
     */
    public function toggleArticleHeart($slug, LoggerInterface $logger)
    {
        // TODO - actually heart/unheart the article!

        $logger->info('Article is being hearted!');

        return new JsonResponse(['hearts' => rand(5, 100)]);
    }
}
