"use client";

import { TravelCard } from "@/components/ui/card-7";
import { Mountain } from "lucide-react";
import { Toaster, toast } from "sonner";

// Demo component to showcase the TravelCard
export default function TravelCardDemo() {
  const handleBooking = () => {
    toast.success("Booking initiated!", {
      description: "Redirecting to booking page...",
    });
  };

  return (
    <>
      {/* The Toaster component is required to display the notifications */}
      <Toaster richColors />
      <div className="flex min-h-screen w-full items-center justify-center bg-background p-4">
        <TravelCard
          imageUrl="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80"
          imageAlt="Misty mountains over a serene lake"
          logo={<Mountain className="h-6 w-6 text-white/80" />}
          title="Manhattan Green Camp"
          location="Cloud City, Atmosphere 78910, Planet Earth"
          overview="Discover nature where spacious campsites, scenic trails, and cozy campfires await. Perfect for families, friends, and solo adventurers."
          price={120}
          pricePeriod="Per Night"
          onBookNow={handleBooking}
          aria-label="Travel card for Manhattan Green Camp"
        />
      </div>
    </>
  );
}
