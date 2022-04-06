<?php

//  namespace App\EventSubscriber;

// use App\Entity\Booking;
// use App\Repository\BookingRepository;
// use CalendarBundle\CalendarEvents;
// use CalendarBundle\Entity\Event;
// use CalendarBundle\Event\CalendarEvent;
// use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Component\EventDispatcher\EventSubscriberInterface;
// use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

// class CalendarSubscriber implements EventSubscriberInterface
// {
//     private $bookingRepository;
//     private $entityManager;
//     private $router;

//     public function __construct(
//         EntityManagerInterface $entityManager,
//         BookingRepository $bookingRepository,
//         UrlGeneratorInterface $router
//     ) {
//         $this->bookingRepository = $bookingRepository;
//         $this->entityManager = $entityManager;
//         $this->router = $router;
//     }

//     public static function getSubscribedEvents()
//     {
//         return [
//             CalendarEvents::SET_DATA => 'onCalendarSetData',
//         ];
//     }

//     public function onCalendarSetData(CalendarEvent $calendar)
//     {
//         $start = $calendar->getStart();
//         $end = $calendar->getEnd();
//         $filters = $calendar->getFilters();

//         // Modify the query to fit to your entity and needs
//         // Change booking.beginAt by your start date property
//         $bookings = $this->entityManager->getRepository(Booking::class)->findAll();
//         //     ->createQueryBuilder('booking')
//         //     ->getQuery()
//         //     ->getResult()
//         // ;

//         dd($bookings);
//         foreach ($bookings as $booking) {
//             // this create the events with your data (here booking data) to fill calendar
//             $bookingEvent = $calendar->addEvent( new Event(
//                 $booking->getTitle(),
//                 $booking->getBeginAt(),
//                 $booking->getEndAt() // If the end date is null or not defined, a all day event is created.
//             ));

//             /*
//              * Add custom options to events
//              *
//              * For more information see: https://fullcalendar.io/docs/event-object
//              * and: https://github.com/fullcalendar/fullcalendar/blob/master/src/core/options.ts
//              */
             
//             $bookingEvent->setOptions([
//                 'backgroundColor' => 'red',
//                 'borderColor' => 'red',
//             ]);
//             $bookingEvent->addOption(
//                 'url',
//                 $this->router->generate('booking_show', [
//                     'id' => $booking->getId(),
//                 ])
//             );

//             $calendar->addEvent(new Event(
//                 'Event 1',
//                 new \DateTime('Tuesday this week'),
//                 new \DateTime('Wednesdays this week')
//             ));

//             // finally, add the event to the CalendarEvent to fill the calendar
//             // $calendar->addEvent($bookingEvent);
//         }
//     }
// } 


namespace App\EventSubscriber;

use App\Entity\Booking;
use CalendarBundle\CalendarEvents;
use Doctrine\ORM\EntityManagerInterface;

use CalendarBundle\Entity\Event;
use CalendarBundle\Event\CalendarEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CalendarSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            CalendarEvents::SET_DATA => 'onCalendarSetData',
        ];
    }

    public function onCalendarSetData(CalendarEvent $calendar, EntityManagerInterface $entityManager)
    {
        $start = $calendar->getStart();
        $end = $calendar->getEnd();
        $filters = $calendar->getFilters();

        // You may want to make a custom query from your database to fill the calendar

        $bookings = $entityManager->getRepository(Booking::class)->findAll();
        // dd($bookings);

        foreach ($bookings as $booking){
        $calendar->addEvent(new Event(
            $booking->getTitle(),
            $booking->getBeginAt(),
            $booking->getEndAt()
        ));
    }
        


        // // If the end date is null or not defined, it creates a all day event
        // $calendar->addEvent(new Event(
        //     'All day event',
        //     new \DateTime('Friday this week')
        // ));
    }
}